<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;



class Product extends Model
{
    // Có thể bỏ qua khai báo $table nếu đặt theo nguyên tắc số nhiều
    protected $table = 'products';
    // Có thể bỏ qua khai báo $primaryKey nếu primary key có tên 'id'
    protected $primaryKey = 'id';

    protected $fillable = [
        'productname',
        'cateid',
        'brand_id',
        'slug',
        'price',
        'pricediscount',
        'image',
        'status',
        'description'
    ];
    // Cấu hình Quan hệ với Category

    public function category()
    {
        // products.cateid = categories.cateid
        return $this->belongsTo(Category::class, 'cateid', 'cateid');
    }

    // Cấu hình Quan hệ với Brand
    public function brand()
    {
        // products.brand_id = brands.brand_id
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    // Cấu hình Quan hệ với ProductImage
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}