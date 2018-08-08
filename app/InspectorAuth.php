<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class InspectorAuth extends Authenticatable
{
    use Notifiable;
 
    protected $table = 'inspectors';
    protected $guard = 'inspector';
 
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'username', 'email', 'password'
    ];
 
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
 
 
    public function getAuthPassword()
    {
        return $this->password;
    }
}
