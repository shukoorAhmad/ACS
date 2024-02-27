<?php

namespace App\Models\WeaponSys;

use App\Models\Lookup\CardType;
use App\Models\Lookup\WeaponType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WeaponSys\WeaponOwner;
use App\Models\Lookup\CardDurationType;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class ApplicantWeapon extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory, LogsActivity;

    protected $fillable = ['valid_date'];

    public function card_type_details()
    {
        return $this->hasOne(CardType::class, 'id', 'card_type_id');
    }

    public function weapon_details()
    {
        return $this->hasOne(WeaponType::class, 'id', 'weapon_type_id');
    }

    public function purpose_details()
    {
        return $this->hasOne(Purpose::class, 'id', 'purpose_id');
    }

    public function applicant_type_details()
    {
        return $this->hasOne(ApplicantType::class, 'id', 'applicant_type_id');
    }

    public function weapon_owner_details()
    {
        return $this->hasOne(WeaponOwner::class, 'id', 'weapon_owner_id');
    }

    public function duration_details()
    {
        return $this->hasOne(CardDurationType::class, 'id', 'duration_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'card_detail_id',
                'weapon_type_id',
                'weapon_no',
                'applicant_type_id',
                'card_type_id',
                'duration_id',
                'valid_date',
                'weapon_owner_id',
                'purpose_id',
                'payable_year',
                'tariff_no',
                'paid_amount',
                'paid_date',
                'created_by',
                'updated_by',
            ])->logOnlyDirty(true)->useLogName('Weapon System Applicant Weapon Model');
    }
}
