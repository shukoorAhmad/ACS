<?php

namespace App\Models\ArmorVehicleSys;

use App\Models\Lookup\District;
use App\Models\Lookup\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Applicant extends Model
{
    protected $connection = 'armor_vehicle_db';
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name',
                'last_name',
                'father_name',
                'name_en',
                'last_name_en',
                'father_name_en',
                'national_ID',
                'permanent_province_id',
                'permanent_district_id',
                'permanent_village',
                'current_province_id',
                'current_district_id',
                'current_village',
                'job',
                'job_en',
                'job_address',
                'contact_no',
                'img',
            ])->logOnlyDirty(true)->useLogName('Armor Vehicle System Organization Model');
    }

    public function per_province()
    {
        return $this->hasOne(Province::class, 'id', 'permanent_province_id');
    }
    public function per_district()
    {
        return $this->hasOne(District::class, 'id', 'permanent_district_id');
    }
    public function cur_province()
    {
        return $this->hasOne(Province::class, 'id', 'current_province_id');
    }
    public function cur_district()
    {
        return $this->hasOne(District::class, 'id', 'current_district_id');
    }
}
