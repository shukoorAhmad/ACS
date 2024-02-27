<?php

namespace App\Models\ArmorVehicleSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ArmorVehicleSys\OrganizationType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Organization extends Model
{
    protected $connection = 'armor_vehicle_db';
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name_da',
                'name_pa',
                'name_en',
                'organization_type_id',
                'tin_no',
                'logo',
            ])->logOnlyDirty(true)->useLogName('Armor Vehicle System Organization Model');
    }

    public function organization_type_details()
    {
        return $this->hasOne(OrganizationType::class, 'id', 'organization_type_id');
    }
}
