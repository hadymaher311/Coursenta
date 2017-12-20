<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
	public function Professor()
	{
	    return $this->belongsTo('App\Professor', 'professor_id');
	}
}
