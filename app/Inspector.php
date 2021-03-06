<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inspector extends Model
{
    protected $table = 'inspectors';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
