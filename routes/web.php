<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
//Route::redirect('/', '/home');

Route::group([
    'middleware' => ['auth']
], function () {
    Route::get('/profile', 'ProfileController@index')->name('profile.index');
    Route::post('/profile/images/upload', 'ProfileController@uploadImages')->name('images.upload');
    Route::post('/profile/images/set-main', 'ProfileController@setMain')->name('images.set-main');

    // Friendship
    Route::get('/check-relationship-status/{id}', 'FriendshipController@check');
    Route::get('/send-add-friend-request/{id}', 'FriendshipController@sendAddFriendRequest');
    Route::get('/accept-friend/{id}', 'FriendshipController@acceptFriend');

    // Notifications
    Route::get('/get-unread-notifications', 'ProfileController@unreadMessages');
    Route::get('/notifications', 'HomeController@readAllNotifications')->name('notifications.all');
    Route::get('/notification/{from}/{id}', 'HomeController@readNotification');

    // Messenger
    Route::get('/messenger', 'MessengerController@index')->name('messenger.index');
    Route::get('/messenger-contacts', 'MessengerController@getContacts')->name('messenger.contacts');
    Route::get('/messenger-conversation/{id}', 'MessengerController@getMessagesFor')->name('messenger.get-messages-for');
    Route::post('/messenger/send', 'MessengerController@send')->name('messenger.send');
});

Route::get('/user/{user}', 'ProfileController@user')->name('user.index');
Route::get('/all-users', 'HomeController@allUsers');

// Tests
//Route::get('/add', function () {
//    return \App\User::find('fb61ced6-3ef4-4f31-ad70-db7eadca2db3')->requestFriend('7ebf2a42-aa89-4af6-95f6-59cb01e63dd6');
//});
//
//Route::get('/accept', function () {
//    return \App\User::find('e2ba5688-ca88-49d6-87ec-37e5334b1478')->acceptFriend('fb61ced6-3ef4-4f31-ad70-db7eadca2db3');
//});
//
//Route::get('/friends', function () {
//    return auth()->user()->friends();
//});
//
//Route::get('/pending', function () {
////    return auth()->user()->pendingFriendRequests();
//    return \App\User::find('7ebf2a42-aa89-4af6-95f6-59cb01e63dd6')->pendingFriendRequests();
//});
//
//Route::get('/is-friends', function () {
//    return \App\User::find('e2ba5688-ca88-49d6-87ec-37e5334b1478')->isFriendWith('fb61ced6-3ef4-4f31-ad70-db7eadca2db3');
//});

//Route::get('/friends', function () {
//    return \App\User::find('fb61ced6-3ef4-4f31-ad70-db7eadca2db3')->friend_ids();
//});
//
//Route::get('/ch', function () {
//    return \App\User::find('7ebf2a42-aa89-4af6-95f6-59cb01e63dd6')->has_pending_friend_request_from('fb61ced6-3ef4-4f31-ad70-db7eadca2db3');
//});