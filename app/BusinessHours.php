<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    protected $table = 'business';
	protected $guarded = [ 'id' ];
}
