@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 p-5">
            <img src="{{ url(''. $user->profile->profileImage()) }}" class="rounded-circle w-100">
        </div>
        <div class="col-md-9 pt-5">
            <div class="d-flex justify-content-between align-items-baseline">
                <div class="d-flex align-items-center pb-3">
                    <div class="h4">{{ $user->username }}</div>
                    <!-- vue button -->
                    <follow-button user-id="{{ $user->id }}" follows="{{ $follows }}"></follow-button>
                </div>
                <!-- Policy -->
                @can('update', $user->profile)
                    <a href="{{ url('/p/create') }}">Add New Post</a>
                @endcan
            </div>

            <!-- Policy -->
            @can('update', $user->profile)
                <a href="{{ url('/profile/' . $user->id) . '/edit' }}">Edit Profile</a>
            @endcan

            <div class="d-flex">
                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                <div class="pr-5"><strong>{{ $followersCount }}</strong> followers</div>
                <div class="pr-5"><strong>{{ $followingCount }}</strong> following</div>
            </div>
            <div class="pt-4 font-weight-bold">{{ $user->profile->title }}</div>
            <div>{{ $user->profile->description }}</div>
            <div><a href="#">{{ $user->profile->url }}</a></div>
        </div>
    </div>
    <div class="row pt-5">

        @foreach($user->posts as $post)
            <div class="col-md-4 pb-4">
                <a href="{{ url('p/' . $post->id) }}">
                    <img src="{{ url('/storage/app/public/'. $post->image) }}" class="w-100">
                </a>
            </div>
        @endforeach()
        
    </div>
</div>
@endsection