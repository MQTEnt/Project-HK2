<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = ['name', 'info', 'desc', 'town_id', 'stat'];

    //Add extra attribute
    protected $attributes = ['avgProgress'];

    //Make extra attribute available in the json response
    protected $appends = ['avgProgress'];

    public function towns() {
		return $this->belongsTo('App\Town', 'town_id', 'id');
	}
	public function projects()
	{
		return $this->hasMany('App\Project', 'requirement_id');
	}

	//Implement the attribute
	public function getAvgProgressAttribute()
	{
		return $this->projects()->where('stat', 1)->avg('progress');
	}
}
