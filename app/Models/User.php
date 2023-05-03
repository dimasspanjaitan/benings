<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'status',
        'name',
        'email',
        'password',
        'upline',
        'phone',
        'instagram',
        'birth_place',
        'birth_date',
        'gender',
        'sub_district',
        'city',
        'address',
        'bank_name',
        'bank_number',
        'level_id',
        'region_id',
        'photo',
        'id_card_photo',
        'id_card_number',
        'another_partner',
        'role'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function levels(){
        return $this->hasOne(Level::class, 'id', 'level_id');
    }

    public function regions(){
        return $this->hasOne(Region::class, 'id', 'region_id');
    }
}
