<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingType extends Model
{
    protected $table = 'business_types';
	protected $guarded = [ 'id' ];
}
