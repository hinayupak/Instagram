<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

	// disables laravel protection
	protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
