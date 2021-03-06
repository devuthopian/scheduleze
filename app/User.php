<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'verified'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }
    public function business()
    {
        return $this->hasOne('App\Business');
    }
    public function user_details()
    {
        return $this->hasOne('App\UserDetails');
    }
    /*public function Panel($id)
    {
        return $this->hasOne('App\PanelTemplate','user_id='.$id);
    }*/
}
