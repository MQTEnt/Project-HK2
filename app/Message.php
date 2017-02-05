<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
	protected $fillable = ['content', 'opend', 'user_id', 'requirement_id'];
	public function requirements() {
		return $this->belongsTo('App\Requirement', 'requirement_id', 'id');
	}
}
