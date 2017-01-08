<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
	protected $fillable = ['name', 'lat', 'lon', 'district_id'];
    public function districts() {
		return $this->belongsTo('App\District', 'district_id', 'id');
	}
	public function requirements()
	{
		return $this->hasMany('App\Requirement', 'town_id');
	}
}
