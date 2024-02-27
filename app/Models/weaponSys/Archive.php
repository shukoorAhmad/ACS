<?php

namespace App\Models\WeaponSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lookup\CartonType;
use App\Models\User;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Archive extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory, LogsActivity;

    public function carton_type_details()
    {
        return $this->hasOne(CartonType::class, 'id', 'carton_type_id');
    }
    public function archive_user_details()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'carton_type_id',
                'year',
                'carton_no',
                'created_by',
                'updated_by',
            ])->logOnlyDirty(true)->useLogName('Weapon System Archive Model');
    }
}
