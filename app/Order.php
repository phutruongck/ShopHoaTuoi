<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $fillable = [
        'user_id', 'product_id', 'qty', 'amount', 'data', 'status'
    ];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function products()
    {
        return $this->belongsTo('App\Product', 'id');
    }

    public function productCategories()
    {
        return $this->belongsTo('App\ProductCategory');
    }
}
