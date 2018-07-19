<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserDetails extends Model
{
    protected $table = 'users_details';
	protected $guarded = [ 'id' ];


	  public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
