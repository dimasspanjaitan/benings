<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function product_detail()
    {
        return $this->hasMany(ProductDetail::class, 'product_group_id');
    }

    public function product_discount()
    {
        return $this->belongsTo(ProductDiscount::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
