<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'purchase_id',
        'product_id',
        'unit',
        'qty',
        'price'
    ];

    public function purchase(){
        return $this->hasOne(Purchase::class, 'id', 'purchase_id');
    }

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
