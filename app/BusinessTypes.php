<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BusinessTypes extends Model
{
    protected $table = 'business_types';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
