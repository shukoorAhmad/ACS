<?php

namespace App\Models\ArmorVehicleSys;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Archive extends Model
{
    protected $connection = 'armor_vehicle_db';
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'year',
                'carton_no',
            ])->logOnlyDirty(true)->useLogName('Armor Vehicle System Organization Model');
    }
}
