<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewFriendRequest extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'broadcast', 'database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('You have received a friend request from ' . $this->user->name)
                    ->action('View Profile', route('user.index', $this->user->id))
                    ->line('Doesnt matter how many friends you have here, nobody loves you in real life!');
    }

//    public function toDatabase($notifiable)
//    {
//        return [
//            'name' => $this->user->name,
//            'message' => ' sent you a friend request.'
//        ];
//    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return DatabaseMessage
     */
//    public function toArray($notifiable)
//    {
//        return [
//            'name' => $this->user->name,
//            'message' => ' sent you a friend request.',
//            'from' => $this->user->id
//        ];
//    }

    public function toDatabase($notifiable)
    {
        $timestamp = Carbon::now()->addSecond()->toDateTimeString();
        return new DatabaseMessage(array(
//            'notifiable_id' => $notifiable->id,
//            'notifiable_type' => get_class($notifiable),
//            'data' => [
                'name' => $this->user->name,
                'message' => ' sent you friend request',
                'from' => $this->user->id,
                'db?' => 'yes',
//            ],
//            'read_at' => null,
//            'created_at' => $timestamp,
//            'updated_at' => $timestamp,
        ));
    }
//
    public function toBroadcast($notifiable)
    {
        $timestamp = Carbon::now()->addSecond()->toDateTimeString();
        return new BroadcastMessage(array(
            'notifiable_id' => $notifiable->id,
            'notifiable_type' => get_class($notifiable),
            'data' => [
                'name' => $this->user->name,
                'message' => ' sent you friend request',
                'from' => $this->user->id,
                'dron don don' => 'dororon'
            ],
            'read_at' => null,
            'created_at' => $timestamp,
            'updated_at' => $timestamp,
        ));
    }

//    public function toBroadcast($notifiable)
//    {
//        return new BroadcastMessage(array(
//            'name' => $this->user->name,
//            'message' => $this->user->name . ' sent you a friend request.'
//        ));
//    }
}
