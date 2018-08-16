<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LocationTime extends Model
{
    protected $table = 'location_time';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
