<?php

namespace App\Models\WeaponSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WeaponOwner extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory;
}
