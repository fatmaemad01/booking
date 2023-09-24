<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\BookingRequest;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;

class SendNotificationForComingRequest extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(protected BookingRequest $bookingRequest)
    {
        
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database' , 'mail'];  //'mail'
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('Dont Forget Your Reservtion.')
                    ->action('Check it', route('member.dashboard'))
                    ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage  //|array
    {
        return new DatabaseMessage($this->createMessage());
    }

    protected function createMessage(): array
    {
        return [
            'title' => 'Do not forget your reservtion',
            'link' => route('member.dashboard'),
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
        ];
    }

}
