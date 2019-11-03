@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit your profile</div>

                    <div class="card-body">
{{--                        @if (session('errors'))--}}
{{--                            <div class="alert alert-success" role="alert">--}}
{{--                                @foreach(session('errors') as $error)--}}
{{--                                    {{ $error }}--}}
{{--                                @endforeach--}}
{{--                            </div>--}}
{{--                        @endif--}}

                        @include('components.flash-messages')

                        <form action="{{ route('profile.update', $profile->id) }}" method="post" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="avatar">Upload Avatar</label>
                                <input type="file" name="avatar" id="avatar" class="form-control" accept="image/*">
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input type="text" name="location" id="location" value="{{ $profile->location }}"
                                       class="form-control">
                            </div>

                            <div class="form-group">
                                <label for="about">About me</label>
                                <textarea name="about" id="about" rows="10"
                                          class="form-control">{{ $profile->about }}</textarea>
                            </div>

                            <div class="form-group">
                                <p class="text-center">
                                    <button class="btn-primary btn-lg" type="submit">
                                        Save your information
                                    </button>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
