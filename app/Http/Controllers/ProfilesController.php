<?php

namespace App\Http\Controllers;

use App\User; // so we can use (User) below
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfilesController extends Controller
{
    public function index(User $user)
    {
    	// dd($user); // fancy laravel vardump
    	// $user = User::findOrFail($user); // replaced by (User)

        // refactored below
        // return view('profiles.index', [
        // 	'user' => $user, 
        // ]);

        $follows = (auth()->user()) ? auth()->user()->following->contains($user->id) : false; // get initial follow state

        return view('profiles.index', compact('user', 'follows')); // refactored from above
    }

    public function edit(User $user)
    {
    	$this->authorize('update', $user->profile); // Policy, only auth users can access this
    	return view('profiles.edit', compact('user')); 
    }

    public function update(User $user)
    {
    	$this->authorize('update', $user->profile);
    	$data = request()->validate([
    		'title' => 'required',
    		'description' => 'required',
    		'url' => 'url',
    		'image' => ''
    	]);

    	if(request('image')) {
			$imagePath = request('image')->store('profile', 'public');
			// fix the path for different OS
			define('DS', DIRECTORY_SEPARATOR);
			$arrayedImagePath = explode("/",$imagePath);
			$fixedImagePath = $arrayedImagePath[0].DS.$arrayedImagePath[1];

			$image = Image::make( public_path('storage'.DS.$fixedImagePath) )->fit(1000, 1000);;
			$image->save();

			$imageArray = ['image' => $imagePath];
    	}

    	// $user->profile->update($data); // non auth users can access this
    	// auth()->user->profile->update($data); // only auth users can access this

    	auth()->user()->profile->update(array_merge(
    		$data,
    		$imageArray ?? []
    	)); // used merge because image path is being inserted

    	return redirect("/profile/{$user->id}");
    }
}
