<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PanelForm extends Model
{
    protected $table = 'appointment_form';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
