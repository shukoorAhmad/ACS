<?php

namespace App\Models\Lookup;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $connection = 'lookup_db';
    use HasFactory;
}
