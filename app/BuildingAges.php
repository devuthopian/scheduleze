<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingAges extends Model
{
    protected $table = 'building_ages';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
