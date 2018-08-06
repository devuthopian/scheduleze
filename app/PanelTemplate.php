<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PanelTemplate extends Model
{
    protected $table = 'panel_template';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
