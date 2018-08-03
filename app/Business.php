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

    public function ages()
    {
    	return $this->hasMany('App\BuildingAges', 'business')->orderBy('rank');
    }

    public function sizes()
    {
    	return $this->hasMany('App\BuildingSizes', 'business')->orderBy('rank');
    }

    public function types()
    {
    	return $this->hasMany('App\BuildingTypes', 'business')->orderBy('rank');
    }
    public function addons()
    {
        return $this->hasMany('App\Addons', 'business')->orderBy('rank');
    }
}
