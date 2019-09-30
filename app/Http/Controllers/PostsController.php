<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class PostsController extends Controller
{
    // only logged in users can access
    public function __construct()
    {
    	$this->middleware('auth');
    }

    public function create()
    {
    	return view('posts.create');
    }

    public function store()
    {
    	$data = request()->validate([
    		// 'another_field' = '' // if a field doesn't need validation
    		'caption' => 'required',
    		'image' => ['required', 'image']
    	]);

    	$imagePath = request('image')->store('uploads', 'public');
    	// fix the path for different OS
    	define('DS', DIRECTORY_SEPARATOR);
    	$arrayedImagePath = explode("/",$imagePath);
    	$fixedImagePath = $arrayedImagePath[0].DS.$arrayedImagePath[1];

    	// dd( public_path('storage'.DS.$fixedImagePath) );

    	$image = Image::make( public_path('storage'.DS.$fixedImagePath) )->fit(1200, 1200);;
    	$image->save();

    	auth()->user()->posts()->create([
    		'caption' => $data['caption'],
    		'image' => $imagePath,
    	]);
    	
    	// \App\Post::create($data); // data storing if (protected $guarded) is disabled, see Post model
    	// dd(request()->all()); // fancy laravel vardump
    	
    	return redirect('profile/' . auth()->user()->id); // redirect after success
    }

    public function show(\App\Post $post) // \App\Post retreives all data
    {
    	return view('posts.show', compact('post'));
    }
}