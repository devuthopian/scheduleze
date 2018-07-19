<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingTypes extends Model
{
    protected $table = 'building_types';
	protected $guarded = [ 'id' ];
}
