<?php

namespace App\Models\WeaponSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantType extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory;
}
