<?php

namespace App\Notifications;

use App\tag;
use Auth;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class DestroyTagNotification extends Notification
{
    use Queueable;

    public $tag;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(tag $tag)
    {
        //
        $this->tag=$tag;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }


    public function Todatabase()
    {
        return [
            'name'=>Auth::user()->name,
            'tag_name'=>$this->tag->name,
        ];
    }
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
