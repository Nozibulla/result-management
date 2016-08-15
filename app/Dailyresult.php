<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dailyresult extends Model {

	protected $fillable = [

		'month',
		'subject',
		'tarikh',
		'marks',
		'student_id',
	];
}
