<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'country_master';

    protected $fillable = [
        'id',
        'status',
        'country_name',
        'country_code',
        'country_flag',
        'currency_code',
    ];
}
