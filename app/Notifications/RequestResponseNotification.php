<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\BookingRequest;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class RequestResponseNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(public BookingRequest $bookingRequest)
    {
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database' , 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line( __('check you request resopnse'))
                    ->action('check it', route('request.index'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage  //|array
    {
        return new DatabaseMessage($this->createMessage($notifiable));
    }

    protected function createMessage(object $notifiable): array
    {
        $bookingRequest = $this->bookingRequest;
        // dd($bookingRequest);
        return [
            'title' => __('Your request to book :space was :status, Check your request for details ' , ['status' => $bookingRequest->status, 'space'=>$bookingRequest->space->name ]),
            'link' => route('request.index'),
        ];
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
