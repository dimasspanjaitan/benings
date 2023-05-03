<?php

namespace App\Models;

use App\Models\Models\ProductImage;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable=[
        'name',
        'slug',
        'summary',
        'description',
        'category_id',
        'status',
        'photo',
        'weight'
    ];

    public function product_detail(){
        return $this->hasMany(ProductDetail::class, 'product_group_id');
    }

    public function product_discount(){
        return $this->belongsTo(ProductDiscount::class, 'product_id');
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public function images(){
        return $this->hasMany(ProductImage::class, 'product_id');
    }
}
