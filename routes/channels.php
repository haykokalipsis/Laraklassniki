<?php

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return  (string) $user->id === (string) $id;
//    return  true;
});

Broadcast::channel('messages.{id}', function ($user, $id) {
    return (string) $user->id === (string) $id;
});

Broadcast::channel('online', function ($user) {
    if (auth()->check()) {
        return $user;
    }
});

//Broadcast::channel('Message', function () {
//    return  true;
////    return  true;
//});
//
