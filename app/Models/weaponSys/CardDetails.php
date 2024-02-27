<?php

namespace App\Models\WeaponSys;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\WeaponSys\Applicant;
use App\Models\WeaponSys\Guarantor;
use App\Models\WeaponSys\ApplicantWeapon;
use App\Models\WeaponSys\Archive;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class CardDetails extends Model
{
    protected $connection = 'weapon_sys_db';
    use HasFactory, LogsActivity;

    protected $fillable = ['approved', 'approved_by', 'approved_at', 'printed', 'printed_by', 'printed_at'];

    public function applicant_details()
    {
        return $this->hasOne(Applicant::class, 'id', 'applicant_id');
    }

    public static function SearchName($name)
    {
        if ($name != '')
            return Applicant::where('name', $name)->get();
    }

    public function guarantor_details()
    {
        return $this->hasOne(Guarantor::class, 'id', 'guarantor_id');
    }
    public function applicant_weapons_details()
    {
        return $this->hasMany(ApplicantWeapon::class, 'card_detail_id', 'id');
    }
    public function user_details()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public function approved_details()
    {
        return $this->hasOne(User::class, 'id', 'approved_by');
    }
    public function print_details()
    {
        return $this->hasOne(User::class, 'id', 'printed_by');
    }
    public function archive_details()
    {
        return $this->hasOne(Archive::class, 'id', 'archive_id');
    }


    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'applicant_id',
                'guarantor_id',
                'order_by',
                'document',
                'approved',
                'approved_by',
                'approved_at',
                'approved_reason',
                'printed',
                'printed_by',
                'printed_at',
                'archive_id',
                'created_by',
                'updated_by',
            ])->logOnlyDirty(true)->useLogName('Weapon System Card Details Model');
    }
}
