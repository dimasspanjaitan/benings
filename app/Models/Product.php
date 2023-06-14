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

    public function prices(){
        return $this->hasMany(PriceLevel::class);
    }

    public function stock(){
        return $this->hasOne(StockView::class, 'id', 'id');
    }

    public function category(){
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

    public static function countActiveProduct(){
        $data = Product::where('status', 1)->count();
        if($data){
            return $data;
        }
        return 0;
    }
    
}
