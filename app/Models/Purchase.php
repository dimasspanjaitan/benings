<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable=[
        'supplier_id',
        'purchase_date',
        'recipient',
        'amount',
        'code',
        'description'
    ];

    public function supplier(){
        return $this->hasOne(Supplier::class, 'id', 'supplier_id');
    }
}
