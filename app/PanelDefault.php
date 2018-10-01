<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PanelDefault extends Model
{
    protected $table = 'panel_default';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
