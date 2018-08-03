<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentForm extends Model
{
    protected $table = 'appointment_panel_form';
	protected $guarded = [ 'id' ];
	
	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
