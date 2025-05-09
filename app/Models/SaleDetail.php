<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'sale_id',
        'product_id',
        'unit',
        'qty',
        'price'
    ];

    public function product(){
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
