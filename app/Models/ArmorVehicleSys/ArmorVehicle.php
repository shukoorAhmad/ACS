<?php

namespace App\Models\ArmorVehicleSys;

use App\Models\Lookup\CardType;
use App\Models\Lookup\Color;
use App\Models\Lookup\Province;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ArmorVehicle extends Model
{
    protected $connection = 'armor_vehicle_db';
    use HasFactory, LogsActivity;

    protected $fillable = ['approved'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'applicant_id',
                'organization_type_id',
                'organization_id',
                'order_by',
                'documents',
                'vehicle_type',
                'vehicle_type_en',
                'product_year', 4,
                'color_id',
                'plate_no',
                'plate_no_en',
                'plate_issue_place_id',
                'engine_no',
                'chassis_no',
                'valid_date',
                'front_img',
                'side_img',
                'plate_img',
                'personal_use',
                'card_type',
                'tariff_no',
                'paid_amount',
                'paid_date',
                'approved',
                'approved_by',
                'approved_reason',
                'printed',
                'printed_by',
                'printed_at',
                'archive_id',
            ])->logOnlyDirty(true)->useLogName('Armor Vehicle System Organization Model');
    }

    public function applicant_details()
    {
        return $this->hasOne(Applicant::class, 'id', 'applicant_id');
    }

    public function organization_type_details()
    {
        return $this->hasOne(OrganizationType::class, 'id', 'organization_type_id');
    }

    public function organization_details()
    {
        return $this->hasOne(Organization::class, 'id', 'organization_id');
    }

    public function color_details()
    {
        return $this->hasOne(Color::class, 'id', 'color_id');
    }

    public function card_type_details()
    {
        return $this->hasOne(CardType::class, 'id', 'card_type');
    }

    public function plate_issue_place_details()
    {
        return $this->hasOne(Province::class, 'id', 'plate_issue_place_id');
    }

    public function archive_details()
    {
        return $this->hasOne(Archive::class, 'id', 'archive_id');
    }
}
