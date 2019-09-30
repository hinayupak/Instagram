@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <img src="{{ url('/storage/app/public/'. $post->image) }}" class="w-100">
        </div>
        <div class="col-md-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-3">
                        <img src="{{ url(''. $post->user->profile->profileImage()) }}" class="rounded-circle w-100" style="max-width: 40px;">
                    </div>
                    <div>
                        <div class="font-weight-bold">
                            <a href="{{ url('profile/' . $post->user->id) }}">
                                <span class="text-dark">{{ $post->user->username }}</span>
                            </a>
                            <a href="javascript:void(0)" class="pl-3">Follow</a>
                        </div class="font-weight-bold">
                    </div>
                </div>
                <hr>
                <p>
                    <span class="font-weight-bold">
                        <a href="{{ url('profile/' . $post->user->id) }}">
                            <span class="text-dark">{{ $post->user->username }}</span>
                        </a>
                    </span class="font-weight-bold"> {{ $post->caption }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection