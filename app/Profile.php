<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
	protected $guarded = [];

    public function profileImage()
    {
    	$imagePath = ($this->image) ? $this->image : 'profile/CpJHajjNIBg052SJgJAqMLSn06lan0hqmVpqdapJ.jpeg';
    	return '/storage/app/public/' . $imagePath;
    }

    public function followers()
    {
    	return $this->belongsToMany(User::class);
    }

    public function user()
    {
    	return $this->belongsTo(User::class);
    }
}
