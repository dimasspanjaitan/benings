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

    // public function product_category()
    // {
    //     return $this->belongsTo(ProductCategory::class);
    // }
}
