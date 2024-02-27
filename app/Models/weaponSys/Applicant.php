<?php

namespace App\Models\WeaponSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Lookup\Province;
use App\Models\Lookup\District;
use App\Models\Lookup\Country;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Applicant extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory, LogsActivity;

    public function per_province()
    {
        return $this->hasOne(Province::class, 'id', 'permanent_province');
    }
    public function per_district()
    {
        return $this->hasOne(District::class, 'id', 'permanent_district');
    }
    public function cur_province()
    {
        return $this->hasOne(Province::class, 'id', 'current_province');
    }
    public function cur_district()
    {
        return $this->hasOne(District::class, 'id', 'current_district');
    }
    public function country_func()
    {
        return $this->hasOne(Country::class, 'id', 'country');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'last_name',
                'father_name',
                'grand_father_name',
                'nationality',
                'country_id',
                'document_type',
                'document_number',
                'permanent_province',
                'permanent_district',
                'permanent_village',
                'current_province',
                'current_district',
                'current_village',
                'job',
                'job_address',
                'contact_no',
                'img',
                'created_by',
                'updated_by',
            ])->logOnlyDirty(true)->useLogName('Weapon System Applicant Model');
    }
}
