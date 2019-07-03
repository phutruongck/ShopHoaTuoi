<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';
    protected $fillable = [
        'name', 'birthday', 'address', 'provinces_id', 'tel', 'email'
    ];

    protected $primaryKey = 'id';

    public function provinces()
    {
        return $this->belongsTo('App\Province');
    }
}
