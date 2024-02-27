<!DOCTYPE html>
<html direction="{{ get_locale() == 'en' ? 'ltr' : 'rtl' }}" dir="{{ get_locale() == 'en' ? 'ltr' : 'rtl' }}" style="direction: {{ get_locale() == 'en' ? 'ltr' : 'rtl' }}">
<!--begin::Head-->

<head>
    <base href="">
    <meta charset="utf-8" />
    <title>{{ trans('words.mcit') }}</title>
    <meta name="description" content="Spinzar MIS" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/base/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/header/menu/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <style>
        .card {
            border: 1px solid #c2c6d1 !important;
        }

        .menu-submenu.menu-submenu-classic.menu-submenu-left {
            padding: 5px 0px !important;
        }

        label.error {
            color: red !important;
            /* font-weight: bold !important; */
            /* font-size: 12px !important */
        }

        .error_message {
            width: 100%;
            margin-top: 0.25rem rem;
            font-size: 100%;
            color: #dc3545;
        }

        * {
            /* font-family: 'B Nazanin' !important; */
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;
        }

        /* Line Awesome Initialization */
        .la,
        .las,
        .lar,
        .lal,
        .lad,
        .lab {
            font-family: 'Line Awesome Free' !important;
        }

        /* Font Awesome Initialization */
        .fa,
        .far,
        .fas {
            font-family: "Font Awesome 5 Free" !important;
        }

        th.datatable-cell>span {
            color: #000 !important;
            font-weight: 900 !important;
            font-size: 1.2rem !important;
        }

        td.datatable-cell>span {
            font-size: 1.1rem !important;
        }

        .select2 {
            width: 100% !important;
        }

        .header .header-menu .menu-nav>.menu-item>.menu-link .menu-text {
            color: #6e7899;
            font-weight: 600;
            font-size: 1.1rem;
        }

        .header-menu .menu-nav>.menu-item .menu-submenu>.menu-subnav>.menu-item>.menu-link .menu-text {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .header-menu .menu-nav>.menu-item .menu-submenu>.menu-subnav>.menu-item.menu-item-active>.menu-link .menu-text {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .form-group label {
            font-weight: 600;
        }

        .header .header-menu .menu-nav>.menu-item>.menu-link .menu-text {
            color: #fff !important;
        }

        .header .header-menu .menu-nav>.menu-item.menu-item-active>.menu-link {
            background-color: #4c5162 !important;
        }

        @media print {
            .hidden-print {
                display: none !important;
            }

            body {
                margin-top: 0 !important;
            }
        }

        .is-invalid .select2-selection,
        .needs-validation~span>.select2-dropdown {
            border-color: red !important;
        }

        .required:after {
            content: "*";
            position: relative;
            font-size: inherit;
            color: red;
            padding-right: 0.25rem;
            font-weight: 600;
        }

        .bg-teal {
            background-color: teal;
        }

        .bg-reject {
            background-color: #F44336;
        }
    </style>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed page-loading">
    <!--begin::Main-->
    <!--begin::Header Mobile-->
    <div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed hidden-print">
        <!--begin::Logo-->
        <a href="{{ route('home') }}">
            <img alt="Logo" src="{{ asset('logo.png') }}" style="max-width: 4rem;" />
        </a>
        <!--end::Logo-->
        <!--begin::Toolbar-->
        <div class="d-flex align-items-center">
            <!--begin::Header Menu Mobile Toggle-->
            <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
                <span></span>
            </button>
            <!--end::Header Menu Mobile Toggle-->
            <!--begin::Topbar Mobile Toggle-->
            <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                <span class="svg-icon svg-icon-xl">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24" />
                            <path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                            <path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
            </button>
            <!--end::Topbar Mobile Toggle-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header Mobile-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="d-flex flex-row flex-column-fluid page">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" class="header header-fixed">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Header Menu Wrapper-->
                        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                            <!--begin::Header Logo-->
                            <div class="header-logo">
                                <a href="{{ route('home') }}">
                                    <img alt="Logo" src="{{ asset('logo.png') }}" style="max-width: 4rem;" />
                                </a>
                            </div>
                            <!--end::Header Logo-->
                            <!--begin::Header Menu-->
                            <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                                <!--begin::Header Nav-->
                                <ul class="menu-nav">
                                    @yield('header-menu')
                                </ul>
                                <!--end::Header Nav-->
                            </div>
                            <!--end::Header Menu-->
                        </div>
                        <!--end::Header Menu Wrapper-->
                        <!--begin::Topbar-->

                        <div class="topbar hidden-print">
                            <!--begin::Languages-->
                            <div class="dropdown">
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                        <img class="h-20px w-20px rounded-sm" src="{{ get_locale() == 'en' ? asset('icons/us-flag.svg') : asset('icons/emirate-flag.png') }}" alt="" />
                                    </div>
                                </div>
                                <!--end::Toggle-->
                                <!--begin::Dropdown-->
                                <div class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Nav-->
                                    <ul class="navi navi-hover py-4">
                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="{{ route('language', 'en') }}" class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <img src="{{ asset('icons/us-flag.svg') }}" alt="" />
                                                </span>
                                                <span class="navi-text">English</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="navi-item active">
                                            <a href="{{ route('language', 'da') }}" class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <img src="{{ asset('icons/emirate-flag.png') }}" alt="" />
                                                </span>
                                                <span class="navi-text">دری</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="{{ route('language', 'pa') }}" class="navi-link">
                                                <span class="symbol symbol-20 mr-3">
                                                    <img src="{{ asset('icons/emirate-flag.png') }}" alt="" />
                                                </span>
                                                <span class="navi-text">پشتو</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Languages-->
                            <!--begin::User-->
                            <div class="topbar-item">
                                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2" id="kt_quick_user_toggle">
                                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">{{ Auth::user()->name }}</span>
                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                        <span class="symbol-label font-size-h5 font-weight-bold">{{ trans('words.ShortCut') }}</span>
                                    </span>
                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid " id="kt_content">
                    @if (Route::currentRouteName() != 'home')
                        @include('layouts.toolbar')
                    @endif
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <!--begin::Container-->
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Entry-->
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer bg-white py-4 d-flex flex-lg-column hidden-print" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted font-weight-bold mr-2">2023©</span>
                            <a href="https://moi.gov.af/" target="_blank" class="text-dark-75 text-hover-primary">{{ trans('words.MOI') }}</a>
                        </div>
                        <!--end::Copyright-->
                        <!--begin::Nav-->
                        <div class="nav nav-dark">
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Main-->
    <!-- begin::User Panel-->
    <div id="kt_quick_user" class="offcanvas offcanvas-right p-10 hidden-print">
        <!--begin::Header-->
        <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
            <h3 class="font-weight-bold m-0 text-primary">{{ trans('words.Profile') }}</h3>
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
        <!--end::Header-->
        <!--begin::Content-->
        <div class="offcanvas-content pr-5 mr-n5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mt-5">
                <div class="symbol symbol-100 mr-5">
                    <form id="avatar_store_form">
                        @csrf
                        <div class="image-input image-input-empty image-input-outline" id="kt_user_edit_avatar" style="background-image: @if (Auth::user()->image != null) url({{ asset('storage/user_images/' . Auth::user()->image) }}) @else url({{ asset('assets/blank.png') }}) @endif">
                            <div class="image-input-wrapper"></div>
                            <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="{{ trans('words.Change Image') }}">
                                <i class="fa fa-pen icon-sm text-muted"></i>
                                <input type="file" name="profile_avatar" accept=".png, .jpg, .jpeg" />
                                <input type="hidden" name="profile_avatar_remove" />
                            </label>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="{{ trans('words.Close') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                            <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="{{ trans('words.Close') }}">
                                <i class="ki ki-bold-close icon-xs text-muted"></i>
                            </span>
                        </div>
                    </form>
                </div>
                <div class="d-flex flex-column">
                    <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{ Auth::user()->name }}</a>
                    <div class="navi mt-2">
                        <a href="#" class="navi-item">
                            <span class="navi-link p-0 pb-2">
                                <span class="navi-icon mr-1">
                                    <span class="svg-icon svg-icon-lg svg-icon-primary">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mail-notification.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24" />
                                                <path d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z" fill="#000000" />
                                                <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5" />
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                                </span>
                                <span class="navi-text text-muted text-hover-primary">{{ Auth::user()->email }}</span>
                            </span>
                        </a>
                        <a href="{{ route('logout') }}" class="btn btn-sm btn-outline-danger font-weight-bolder py-2 px-5 btn-block" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span class="fa fa-power-off float-left mt-1"></span>
                            {{ trans('words.Log Out') }}
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
            <!--end::Header-->

            <!--begin::Separator-->
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <!--end::Separator-->

            <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
                <h3 class="font-weight-bold m-0 text-primary">{{ trans('words.Password') }}</h3>
            </div>

            <form action="{{ route('change-user-password') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <label for="old_password">{{ trans('words.Old Password') }}</label>
                        <input type="password" class="form-control" id="old_password" name="old_password" required>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <label for="password">{{ trans('words.New Password') }}</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="col-xs-12 col-md-12">
                        <label for="password_confirmation">{{ trans('words.Confirm New Password') }}</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                    </div>
                </div>
                <div class="mt-4">
                    <button class="btn btn-outline-dark btn-block" type="submit">{{ trans('words.Change Password') }}</button>
                </div>
            </form>
            <!--begin::Separator-->
            <div class="separator separator-dashed mt-8 mb-5"></div>
            <!--end::Separator-->
        </div>
        <!--end::Content-->
    </div>
    <!-- end::User Panel-->
    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop hidden-print">
        <span class="svg-icon">
            <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg-->
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <polygon points="0 0 24 0 24 24 0 24" />
                    <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1" />
                    <path d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z" fill="#000000" fill-rule="nonzero" />
                </g>
            </svg>
            <!--end::Svg Icon-->
        </span>
    </div>
    <!--end::Scrolltop-->

    <!--end::Demo Panel-->
    <script>
        // var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";
    </script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>
        var KTAppSettings = {
            "breakpoints": {
                "sm": 576,
                "md": 768,
                "lg": 992,
                "xl": 1200,
                "xxl": 1400
            },
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };
    </script>
    <!--end::Global Config-->
    <!--begin::Global Theme Bundle(used by all pages)-->
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Theme Bundle-->
    <!--begin::Page Vendors(used by this page)-->
    <script src="{{ asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js') }}"></script>
    <script src="{{ asset('assets/plugins/custom/gmaps/gmaps.js') }}"></script>
    <!--end::Page Vendors-->
    <!--begin::Page Scripts(used by this page)-->
    <script src="{{ asset('assets/js/pages/widgets.js') }}"></script>
    <script src="{{ asset('assets/plugins/jquery validation/jquery.validate.min.js') }}"></script>

    {{-- <script src="assets/js/pages/crud/forms/widgets/select2.js"></script> --}}
    <!--end::Page Scripts-->

    <script>
        $('.select2').select2({
            width: '100%'
        });

        var avatar = new KTImageInput('kt_user_edit_avatar');

        $("input[name=profile_avatar]").change(function() {
            startModalLoader();
            var myformData = new FormData($('#avatar_store_form')[0]);
            $.ajax({
                method: 'POST',
                processData: false,
                contentType: false,
                cache: false,
                data: myformData,
                enctype: 'multipart/form-data',
                url: "{{ route('change-user-image') }}",
                success: function(response) {
                    if (response == true) {
                        success("{{ trans('words.Successfully Edited') }}");
                        setTimeout(() => {
                            location.reload();
                        }, 700);
                    } else {
                        var response = JSON.parse(response);
                        $.each(response, function(prefix, val) {
                            error_function(val[0]);
                        });
                    }
                    stopModalLoader();
                },
                error: function() {
                    error_function("{{ trans('words.Please Try Again') }}");
                    stopModalLoader();
                }
            });
        });

        const success = (msg) => {
            Swal.fire({
                title: msg,
                text: "",
                icon: "success",
                confirmButtonText: "{{ trans('words.Close') }}"
            });
        }

        const error_function = (msg) => {
            Swal.fire({
                title: msg,
                text: "",
                icon: "error",
                confirmButtonText: "{{ trans('words.Close') }}"
            });
        }

        const startPageLoader = () => {
            KTApp.blockPage({
                overlayColor: '#000000',
                state: 'primary',
                opacity: 0.5,
                size: 'lg',
                message: "{{ trans('words.Please Wait') }}"
            });
        }

        const stopPageLoader = () => {
            KTApp.unblockPage();
        }

        const startModalLoader = (modalId) => {
            KTApp.block('.modal .modal-content', {
                overlayColor: '#000000',
                state: 'primary',
                opacity: 0.5,
                size: 'lg', //available custom sizes: sm|lg
                message: "{{ trans('words.Please Wait') }}"
            });
        }

        const stopModalLoader = (modalId) => {
            KTApp.unblock('.modal .modal-content');
        }

        var timeout = ({{ config('session.lifetime') }} * 60000) + 1000;
        setTimeout(function() {
            window.location.reload(1);
        }, timeout);
    </script>

    @if (Session::has('success'))
        <script>
            success("{{ Session::get('success') }}");
        </script>
    @endif

    @if (Session::has('wrong_pwd'))
        <script>
            error_function("{{ Session::get('wrong_pwd') }}");
        </script>
    @endif

    @yield('scripts')

</body>
<!--end::Body-->

</html>
