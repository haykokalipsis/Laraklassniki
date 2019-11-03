<?php

namespace App\Traits;

use App\Friendship;
use App\User;

trait Friendable
{
    // Создать запрос на добавление от юзверя
    public function request_friendship($responder)
    {
        if ($this->id === $responder)
            return false;

        if ($this->is_friends_with($responder) === 1)
            return "Already friends";

        if ($this->has_pending_friend_request_sent_to($responder) === 1)
            return "Already sent a friend request";

        if ($this->has_pending_friend_request_from($responder) === 1)
            return $this->accept_friend($responder);


        $friendship = Friendship::create([
            'requester' => $this->id,
            'responder' => $responder
        ]);

        if ($friendship)
            return 1;
//            return response()->json('Ok', 200);
        return 0;
//        return response()->json('fail', 501);
    } 

    // Принять запрос на добавление
    public function accept_friend($requester)
    {
        if ($this->has_pending_friend_request_from($requester) === 0)
            return 0;

        $friendship = Friendship::where([
            'requester' => $requester,
            'responder' => $this->id
        ])->first();

        if ($friendship) {
            $friendship->update([
                'status' => 1
            ]);

            return 1;
        }
        
        return 0;
    } 

    // Друзья текущего юзверя
    public function friends()
    {
        $f1 = array();
        $f2 = array();
        $friends = array();

        $friends1 = Friendship::where('status', 1)
            ->where('requester', $this->id)
            ->get();

        $friends2 = Friendship::where('status', 1)
            ->where('responder', $this->id)
            ->get();

        foreach ($friends1 as $friendship) {
            array_push($friends, User::find($friendship->responder));
        }

        foreach ($friends2 as $friendship) {
            array_push($friends, User::find($friendship->requester));
        }

        return $friends;
    }

    // From who we have got requests
    public function pending_friend_requests_received()
    {
        $users = array();

        $friendships = Friendship::where('status', 0)
            ->where('responder', $this->id)
            ->get();

        foreach ($friendships as $friendship) {
            array_push($users, User::find($friendship->requester));
        }

        return $users;
    }

    // To whom we have sent requests
    public function pending_friend_requests_sent()
    {
        $users = array();

        $friendships = Friendship::where('status', 0)
            ->where('requester', $this->id)
            ->get();

        foreach ($friendships as $friendship) {
            array_push($users, User::find($friendship->responder));
        }

        return $users;
    }

    // ids of current users friends
    public function friend_ids()
    {
        return collect($this->friends())->pluck('id')->toArray();
    }

    // ids of current users pending requests (requests to friend us)
    public function pending_friend_requests_received_ids()
    {
        return collect($this->pending_friend_requests_received())->pluck('id')->toArray();
    }

    // ids of current users pending requests sent(requests from us to friend them)
    public function pending_friend_requests_sent_ids()
    {
        return collect($this->pending_friend_requests_sent())->pluck('id')->toArray();
    }

    // Has this user send request to us?
    public function has_pending_friend_request_from($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_received_ids()))
            return 1;

        return 0;
    }

    // Have we sent request to this user?
    public function has_pending_friend_request_sent_to($user_id)
    {
        if (in_array($user_id, $this->pending_friend_requests_sent_ids()))
            return 1;

        return 0;
    }

    public function is_friends_with($user_id)
    {
        if (in_array($user_id, $this->friend_ids()))
            return 1;

        return 0;
    }
}
