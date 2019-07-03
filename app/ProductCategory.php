<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    protected $table = 'product_categories';
    protected $fillable = [
        'name', 'content', 'link_image'
    ];

    protected $primaryKey = 'id';

    public function products()
    {
        return $this->hasMany('App\Product', 'catalog_id');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }
}
