<?php

namespace App\Models\WeaponSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lookup\Province;
use App\Models\Lookup\District;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Guarantor extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory, LogsActivity;

    public function cur_province()
    {
        return $this->hasOne(Province::class, 'id', 'current_province_id');
    }
    public function cur_district()
    {
        return $this->hasOne(District::class, 'id', 'current_district_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'father_name',
                'grand_father_name',
                'nationalID',
                'current_province_id',
                'current_district_id',
                'current_village',
                'rank',
                'job',
                'contact_no',
                'created_by',
                'updated_by',
            ])->logOnlyDirty(true)->useLogName('Weapon System Guarantor Model');
    }
}
