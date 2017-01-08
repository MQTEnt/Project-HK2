<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model
{
    protected $fillable = ['name', 'info', 'desc', 'town_id', 'stat'];
    public function towns() {
		return $this->belongsTo('App\Town', 'town_id', 'id');
	}
}
