<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessHours extends Model
{
    protected $table = 'bushour';
	protected $guarded = [ 'id' ];
}
