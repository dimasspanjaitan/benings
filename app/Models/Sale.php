<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'status',
        'total',
        'sale_date',
        'code'
    ];

    public function user(){
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function details(){
        return $this->hasMany(SaleDetail::class, 'sale_id');
    }
}
