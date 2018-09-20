<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ServiceContent extends Model
{
    protected $table = 'service_content';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
