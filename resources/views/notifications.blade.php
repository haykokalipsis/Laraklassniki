@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Notifications</div>

                    <div class="card-body">

                        <ul class="list-group">
                            @forelse($notifications as $notification)
{{--                                @dump($notification->data)--}}
                                <li class="list-group-item">
                                    <span class="float-left">{{ $notification->data['name'] }} &nbsp; {{ $notification->data['message'] }}</span>
                                    <span class="float-right">{{ $notification->created_at->diffForHumans() }}</span>
                                </li>
                            @empty
                                <li class="list-group-item">Notifications</li>
                            @endforelse
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection