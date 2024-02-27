<?php

namespace App\Models\WeaponSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WeaponSys\Purpose;
use App\Models\WeaponSys\WeaponOwner;

class PaymentDetail extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory;

    public function weapon_owner_function()
    {
        return $this->hasOne(WeaponOwner::class, 'id', 'weapon_owner_id');
    }

    public function purpose_function()
    {
        return $this->hasOne(Purpose::class, 'id', 'purpose_id');
    }
}
