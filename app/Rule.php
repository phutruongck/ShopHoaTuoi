<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{
    protected $table = 'rules';
    protected $fillable = [
        'name'
    ];

    protected $primaryKey = 'id';

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
