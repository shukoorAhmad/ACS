<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ trans('words.Print Card') }}</title>
    <link rel="shortcut icon" href="{{ asset('logo.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('idCard.css') }}">
    <style>
        .employee-card {
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            background-color: #f0f0f0;
            display: flex;
            align-items: center;
        }

        .employee-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            overflow: hidden;
        }

        .employee-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .employee-details {
            margin-left: 10px;
        }

        .employee-name {
            font-size: 18px;
            margin: 0;
        }

        .father-name {
            font-size: 14px;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="padding">
            <div class="font">
                <div class="top">
                    <h3 style="text-align: center;color:white;padding-top:10%">وزارت مخابرات و تکنالوژی معلوماتی</h3>
                    <img src="{{ asset($employee->photo) }}">
                </div>
                <div class="bottom">
                    <p>{{ $employee->name . ' - ' . $employee->father_name }}</p>
                    <p class="desi">{{ trans('words.ID') . ': ' . $employee->special_id }}</p>
                    <div class="barcode">
                        @php $bc='http://localhost/ACS/verify-employee/'.$employee->special_id; @endphp
                        {{ QrCode::Gradient(195, 146, 90, 30, 40, 50, 'vertical')->style('round')->size(80)->generate($bc) }}
                    </div>
                    <br>
                    <p class="no"><b>{{ trans('words.Expiry Date') }}</b> {{ to_jalali($employee->expiry_date) }}</p>
                    <p class="no"></p>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
