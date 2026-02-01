<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Vendor extends Authenticatable
{
    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'email',
        'password',
        'company_name',
        'phone',
        'website',
        'location',
        'image',
    ];

    protected $hidden = [
        'password',
    ];
}
