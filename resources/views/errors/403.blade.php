<!DOCTYPE html>
<html lang="en">
<style>
    html {
        background: url('icons/ad.jpg') no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        height: 40vh !important;
    }

    * {
        font-family: Arial, Helvetica, sans-serif;
    }

    h2 {
        text-align: center
    }

    a {
        text-decoration: none;
        color: #144ba3 !important
    }
</style>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('words.Access Denied') }}</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
</head>

<body>
    <h2>
        <a href="{{ route('login') }}">{{ trans('words.Login') }}</a>
    </h2>
</body>

</html>
