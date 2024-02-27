@if (!$employee)
    <h3 class='text-center bg-danger p-5 text-white'>{{ trans('words.Data Not Found') }}</h3>
@elseif ($employee->expiry_date < date('Y-md'))
    <h3 class='text-center bg-danger p-5 text-white'>{{ trans('words.Card Expired') }}</h3>
@else
    <div class="col-sm-12 col-md-6">
        <div class="row">
            <div class="col-sm-12 col-md-8">
                <h4><b>{{ trans('words.Name') }}:</b> {{ $employee->name }}</h4>
                <h4><b>{{ trans('words.Father Name') }}:</b>{{ $employee->father_name }}</h4>
                <h4><b>{{ trans('words.Expiry Date') }}:</b>{{ to_jalali($employee->expiry_date) }}</h4>
            </div>
            <div class="col-sm-12 col-md-4">
                <img src="{{ asset($employee->photo) }}" class="img-thumbnil">
            </div>
        </div>

    </div>
@endif
