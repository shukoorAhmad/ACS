<?php

use App\Models\Acs\Employee;
use App\Models\Auth\UserSystem;
use Illuminate\Support\Str;
use Mpdf\Tag\P;

function encode_id($id)
{
    return base64_encode(Str::random(30) . '-' . base64_encode($id));
}

function decode_id($id)
{
    $x = base64_decode($id);
    $x = explode('-', $x)[1];
    return base64_decode($x);
}

function to_gregorian($date)
{
    return \Morilog\Jalali\Jalalian::fromFormat('Y-m-d', $date)->toCarbon();
}

function to_jalali($date)
{
    return \Morilog\Jalali\CalendarUtils::strftime('Y-m-d', strtotime($date));
}

function uid()
{
    return auth()->user()->id;
}

function hasAccessToSystem($system_id)
{
    $user_system = UserSystem::where('user_id', auth()->user()->id)->where('system_id', $system_id)->select('user_id', 'system_id')->first();
    return $user_system == null ? false : true;
}


function can($can)
{
    return auth()->user()->can($can);
}

function get_locale()
{
    return session()->get('locale');
}

function getNextId()
{
    return Employee::max('id') + 1;
}

function setSpecialId($id)
{
    $year = date('Y-m');
    return uid() . '_' . explode('-', $year)[0] . explode('-', $year)[1] . '-' . str_pad($id, 5, "0", STR_PAD_LEFT);
}
