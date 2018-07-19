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
}
