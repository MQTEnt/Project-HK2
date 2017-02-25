<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
	protected $fillable = ['name', 'from_date', 'to_date', 'items', 'note', 'user_id', 'stat', 'requirement_id', 'plan', 'noti_phone', 'noti_email', 'project_stat', 'progress', 'rating', 'money'];
	public function requirements() {
		return $this->belongsTo('App\Requirement', 'requirement_id', 'id');
	}
}
