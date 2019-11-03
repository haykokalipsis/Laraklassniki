<?php

namespace App\Http\Controllers;

use App\Notifications\FriendRequestAccepted;
use Illuminate\Http\Request;
use App\Notifications\NewFriendRequest;
use App\User;

class FriendshipController extends Controller
{
    public function check($id)
    {
        if (auth()->user()->is_friends_with($id) === 1)
            return ['status' => 'friends'];

        if (auth()->user()->has_pending_friend_request_from($id))
            return ['status' => 'waiting for my action'];

        if (auth()->user()->has_pending_friend_request_sent_to($id) === 1)
            return ['status' => 'waiting for users action'];

        return ['status' => 0];
    }
    
    public function sendAddFriendRequest($responder_id)
    {
        // Send notification, email, broadcasting
        $response = auth()->user()->request_friendship($responder_id);
        User::find($responder_id)->notify(new NewFriendRequest(auth()->user() ) );
        return $response;
    }

    public function acceptFriend($requester_id)
    {
        // Send notification, email, broadcasting

        $response = auth()->user()->accept_friend($requester_id);
        User::find($requester_id)->notify(new FriendRequestAccepted(auth()->user() ) );
        return $response;
    }
}
