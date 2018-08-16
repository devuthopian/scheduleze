<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonBookings extends Model
{
    protected $table = 'addons_bookings';
	protected $guarded = [ 'id' ];
	
	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
}
