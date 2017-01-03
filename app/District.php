<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class District extends Model
{
	public function cities() {
		return $this->belongsTo('App\City', 'city_id', 'id');
	}
	public function towns()
	{
		return $this->hasMany('App\Town', 'district_id');
	}
}
