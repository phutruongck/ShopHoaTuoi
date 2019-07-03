<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'users';
    protected $fillable = [
        'name', 'email', 'password', 'birthday', 'address', 'cellphone', 'province_id', 'rule', 'status'
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function customers()
    {
        return $this->hasMany('App\Customer');
    }

    public function orders()
    {
        return $this->hasMany('App\Order');
    }

    public function rules()
    {
        return $this->hasMany('App\Rule');
    }

    public function provinces()
    {
        return $this->hasMany('App\Province', 'id');
    }
}
