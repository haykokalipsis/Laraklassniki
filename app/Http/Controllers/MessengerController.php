<?php

namespace App\Http\Controllers;

use App\Events\NewMessage;
use App\Message;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessengerController extends Controller
{
    public function index()
    {
        return view('messenger');
    }

    public function getContacts()
    {
        $contacts = User::with(['avatar'])->where('id', '!=', auth()->id())->get();

        $unreadIds = Message::select(DB::raw('`sender` as sender_id, count(`sender`) as unread_messages_count'))
            ->where('receiver', auth()->id())
            ->where('unread', false)
            ->groupBy('sender')
            ->get();

        $contacts = $contacts->map(function($contact) use ($unreadIds) {
            $contactUnread = $unreadIds->where('sender_id', $contact->id)->first();
            $contact->unread = $contactUnread ? $contactUnread->unread_messages_count : 0;

            return $contact;
        });

//        dd(count($contacts));
//        $contacts->forget(auth()->id());
//        dd($contacts);

        return response()->json($contacts);
    }

    public function getMessagesFor($contact)
    {

        // Mark all messages with the selected contact as read. (i have unread field, should name it to read)
        Message::where('sender', $contact)->where('receiver', auth()->id())->update(['unread' => true]);

        $messages = Message::where(function($q) use ($contact) {
            $q->where('sender', auth()->id());
            $q->where('receiver', $contact);
        })->orWhere(function ($q) use ($contact) {
            $q->where('sender', $contact);
            $q->where('receiver', auth()->id());
        })->get();

        return response()->json($messages);
    }

    public function send(Request $request)
    {
        $message = Message::create([
            'sender' => auth()->id(),
            'receiver' => $request->contact_id,
            'body' => $request->body
        ]);

        broadcast(new NewMessage($message));

        return response()->json($message);
    }
}