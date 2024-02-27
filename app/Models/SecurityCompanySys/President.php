<?php

namespace App\Models\SecurityCompanySys;

use App\Models\Lookup\Country;
use App\Models\Lookup\District;
use App\Models\Lookup\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class President extends Model
{
    protected $connection = 'security_company_db';
    use HasFactory, LogsActivity;
    use HasFactory;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'company_id',
                'name_da',
                'name_en',
                'last_name_da',
                'last_name_en',
                'father_name',
                'email',
                'contact_no',
                'nid_pass_no',
                'country_id',
                'permanent_province_id',
                'permanent_district_id',
                'permanent_village',
                'city',
                'street_no',
                'main_office_address',
                'current_province_id',
                'current_district_id',
                'current_village',
                'status',
                'status_reason',
                'status_attachments',
                'image',
                'attachments',
            ])->logOnlyDirty(true)->useLogName('Security Company System Company Model');
    }

    public function country_details()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }

    public function permanent_province_details()
    {
        return $this->hasOne(Province::class, 'id', 'permanent_province_id');
    }
    public function permanent_district_details()
    {
        return $this->hasOne(District::class, 'id', 'permanent_province_id');
    }

    public function current_province_details()
    {
        return $this->hasOne(Province::class, 'id', 'current_province_id');
    }

    public function current_district_details()
    {
        return $this->hasOne(District::class, 'id', 'permanent_province_id');
    }
}
