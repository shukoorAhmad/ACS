<?php

namespace App\Models\Acs;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory, SoftDeletes;

    function created_by_details()
    {
        return  $this->hasOne(User::class, 'id', 'created_by');
    }
}
