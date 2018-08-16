<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $table = 'business';
	protected $guarded = [ 'id' ];


	public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function BuildingAges()
    {
    	return $this->hasMany('App\BuildingAges', 'business')->where('removed', 0)->orderBy('rank');
    }

    public function BuildingSizes()
    {
    	return $this->hasMany('App\BuildingSizes', 'business')->where('removed', 0)->orderBy('rank');
    }

    public function BuildingTypes()
    {
    	return $this->hasMany('App\BuildingTypes', 'business')->where('removed', 0)->orderBy('rank');
    }

    public function Addons()
    {
        return $this->hasMany('App\Addons', 'business')->where('removed', 0);
    }

    public function Location()
    {
        return $this->hasMany('App\Location', 'business')->where('removed', 0);
    }

    public function Inspector()
    {
        return $this->hasMany('App\UserDetails', 'business')->where('removed', 0);
    }
}