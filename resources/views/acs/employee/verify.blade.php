<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>چک کارت</title>
    <link href="{{ asset('assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
</head>

<body>
    @php $employee = App\Models\Acs\Employee::select('name','father_name','special_id','photo','expiry_date')->findOrFail($id); @endphp
    <div class="container mt-19">
        <img src="{{ asset('logo.png') }}" alt="" style="max-width: 100px !important;">
        <h3 class="text-center bg-primary text-white p-5">وزارت مخابرات و تکنالوژی معلوماتی</h3>
        <h4 class="text-center bg-info text-white p-4 mr-4 ml-4">مشخصات کارمند</h4>
        <div class="row mr-10 ml-10">
            @if (!$employee)
                <h3 class='text-center bg-danger p-5 text-white'>دریافت نگردید</h3>
            @elseif ($employee->expiry_date < date('Y-md'))
                <h3 class='text-center bg-danger p-5 text-white'>قابل اعتبار نیست</h3>
            @else
                <div class="col-sm-12 col-md-4">
                    <img src="{{ asset($employee->photo) }}">
                </div>
                <div class="col-sm-12 col-md-4">
                    <h4><b>اسم:</b> {{ $employee->name }}</h4>
                    <h4><b>اسم پدر:</b>{{ $employee->father_name }}</h4>
                    <h4><b>تاریخ ختم:</b>{{ to_jalali($employee->expiry_date) }}</h4>
                </div>
            @endif
        </div>
    </div>

</body>

</html>
