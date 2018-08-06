<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IndustriesTable extends Model
{
    protected $table = 'industries';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
