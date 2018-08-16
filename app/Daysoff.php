<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Daysoff extends Model
{
    protected $table = 'daysoff';
	protected $guarded = [ 'id' ];
}
