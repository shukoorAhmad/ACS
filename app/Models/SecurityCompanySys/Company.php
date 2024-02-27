<?php

namespace App\Models\SecurityCompanySys;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Company extends Model
{
    protected $connection = 'security_company_db';
    use HasFactory, LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logOnly([
                'name_da',
                'name_en',
                'logo',
            ])->logOnlyDirty(true)->useLogName('Security Company System Company Model');
    }

    public function created_by_details()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }
}
