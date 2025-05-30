<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable=[
        'status',
        'title',
        'slug',
        'description'
    ];

    public $timestamps = false;

    public function products(){
        return $this->hasMany(Product::class,'category_id','id')->where('status', 1);
    }

    public static function getProductByCat($slug){
        return Category::with('products')->where('slug',$slug)->first();
    }

    public static function countActiveCategory(){
        $data = Category::where('status', 1)->count();
        if($data){
            return $data;
        }
        return 0;
    }
}
