<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_group_id');
    }
}
