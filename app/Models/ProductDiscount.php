<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDiscount extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function product()
    {
        return $this->hasOne(Product::class, 'id', 'product_id');
    }
}
