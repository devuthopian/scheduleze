<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuildingSizes extends Model
{
    protected $table = 'building_sizes';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
