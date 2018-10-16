<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
	protected $table = 'bookings';
	protected $guarded = [ 'id' ];

	public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }

    public function building_types()
    {
        return $this->belongsTo('App\BuildingTypes', 'building_type')->where('removed', 0);
    }

   	public function building_sizes()
    {
        return $this->belongsTo('App\BuildingSizes', 'building_size')->where('removed', 0);
    }

    public function building_ages()
    {
        return $this->belongsTo('App\BuildingAges', 'building_age')->where('removed', 0);
    }

    public function locations()
    {
        return $this->belongsTo('App\Location', 'location');
    }
}
