<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Settings extends Model
{
    use HasFactory;

    protected $fillable=[
        'description',
        'short_des',
        'logo',
        'logo_admin',
        'favicon',
        'photo',
        'address',
        'phone',
        'email',
    ];
}
