<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';
    protected $fillable = [
        'catalog_id', 'name', 'content', 'price', 'discount', 'image_link', 'image_list', 'view'
    ];

    protected $primaryKey = 'id';

    public function productCategories()
    {
        return $this->belongsTo('App\ProductCategory', 'catalog_id');
    }
}
