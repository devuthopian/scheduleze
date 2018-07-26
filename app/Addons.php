<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addons extends Model
{
    protected $table = 'addons';
	protected $guarded = [ 'id' ];
	
	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
