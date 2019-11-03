@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <p class="text-center">
                            {{ $user->name }}'s Profile
                        </p>
                    </div>

                    <div class="panel-body">
                        <p class="text-center">
                            <img src="{{ Storage::url($user->avatar) }}" width="70px" height="70px" style="border-radius: 50%;" alt="">
                        </p>

                        @if (auth()->id() === $user->id)
                            <p class="text-center">
                                <a href="{{ route('profile.edit') }}" class="btn btn-lg btn-info">Edit your profile</a>
                            </p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
