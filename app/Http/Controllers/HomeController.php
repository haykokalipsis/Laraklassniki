<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->get();
		
        return view('home', compact('users'));
    }

    public function allUsers()
    {
        return User::all();
    }

    public function readAllNotifications()
    {
//        dd(auth()->user()->notifications);
        auth()->user()->unreadNotifications->markAsRead();
        return view('notifications')->with('notifications',  auth()->user()->notifications);
    }

    public function readNotification($from, $id)
    {
        $notification = auth()->user()->notifications()->where('id', $id)->first();

        if ($notification) {
            $notification->markAsRead();

            return redirect()->route('user.index', $from);
        }

        return redirect()->route('user.index', $from);
    }

}
