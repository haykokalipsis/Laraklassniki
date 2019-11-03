@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row mt-5 justify-content-start">
            @foreach($users as $user)
                    <div class="card card-custom mx-2 mb-3 col-2">
                        <img class="card-img-top" src="{{ $user->lastImage ? asset('img/users/' . $user->avatar->thumbnail_path ) : asset('img/defaults/avatars/male.png') }}" alt="Card image">

                        <online-user-component class="justify-content-space-between" :user="{{ $user }}"></online-user-component>

                        <div class="card-body">
                            <h4 class="card-title">{{ $user->name }}</h4>
                            <p class="card-text">{{ $user->email }}</p>
                            <a href="{{ route('user.index', $user->id) }}" class="btn btn-primary">See Profile</a>
                        </div>
                    </div>
            @endforeach
        </div>
    </div>
@endsection
