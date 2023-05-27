<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'status',
        'name',
        'level_id',
        'phone',
        'email',
        'address',
        'description'
    ];

    public function levels(){
        return $this->hasOne(Level::class, 'id', 'level_id');
    }
}
