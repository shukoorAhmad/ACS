<!doctype html>
<html lang="en">

<head>
    <title>{{ trans('words.Login Page') }}</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="{{ asset('login-style.css') }}">
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <style>
        * {
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif !important;
        }
    </style>
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 col-lg-10">
                    <div class="wrap d-md-flex">
                        <div class="login-wrap p-4">
                            <div class="d-flex">
                                <div class="w-100 text-center">
                                    <img class="pt-0 mt-0" src="{{ asset('logo.png') }}" alt="" width="100" height="100">
                                    <h4 class="text-center" style="color: #144ba3;"><b>{{ trans('words.mcit') }}</i></b></h4>
                                    <h5 class="text-center font-weight-bolder ">{{ trans('words.Login Page') }}</h5>
                                    @if (session()->has('token_expired_error'))
                                        <h4 class="text-center alert-danger text-danger">{{ trans('words.Token Expired') }}</h4>
                                    @endif
                                </div>
                            </div>
                            <form method="POST" action="{{ route('login') }}" class="signin-form">
                                @csrf
                                <div class="form-group mb-3 rtl">
                                    <label class="label" for="name">{{ trans('words.Username') }}</label>
                                    <input type="text" value="Administrator" name="username" class="form-control rtl @error('username') is-invalid @enderror" placeholder="{{ trans('words.Enter Your_', ['name' => trans('words.Email')]) }}" required value="{{ old('username') }}">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group mb-3 rtl">
                                    <label class="label" for="password">{{ trans('words.Password') }}</label>
                                    <input type="password" value="Password!@#123" id="password" name="password" class="form-control rtl @error('password') is-invalid @enderror" autocomplete="current-password" placeholder="{{ trans('words.Enter Your_', ['name' => trans('words.Password')]) }}" required>
                                    <span id="toShowPassword" style="float:left; font-size: 1.1rem; margin-top: -2.1rem; margin-left: 0.6rem;" class="fa fa-eye"></span>
                                    <span id="toHidePassword" style="float:left; font-size: 1.1rem; margin-top: -2.1rem; margin-left: 0.6rem;" class="fa fa-eye-slash d-none"></span>
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="form-control btn btn-primary rounded submit px-3 font-weight-bolder">{{ trans('words.Login') }}</button>
                                </div>
                            </form>
                        </div>
                        <div class="img" style="background-image: url('logo.png');object-fit: cover !important;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="{{ asset('jquery-3.7.0.min.js') }}"></script>
<script>
    $('#toShowPassword').click(function() {
        $('#toShowPassword').addClass('d-none');
        $('#toHidePassword').removeClass('d-none');
        $('#password').attr('type', 'text');
    });
    $('#toHidePassword').click(function() {
        $('#toShowPassword').removeClass('d-none');
        $('#toHidePassword').addClass('d-none');
        $('#password').attr('type', 'password');
    });

    var timeout = ({{ config('session.lifetime') }} * 60000) - 10000;
    setTimeout(function() {
        window.location.reload(1);
    }, timeout);
</script>

</html>
