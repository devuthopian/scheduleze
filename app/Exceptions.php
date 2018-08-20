<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exceptions extends Model
{
    protected $table = 'exceptions';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
