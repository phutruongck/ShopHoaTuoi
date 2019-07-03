<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $table = 'provinces';
    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User', 'province_id');
    }

    public function customers()
    {
        return $this->belongsTo('App\User');
    }
}
