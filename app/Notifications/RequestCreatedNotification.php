<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use App\Models\BookingRequest;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Support\Facades\Auth;

class RequestCreatedNotification extends Notification
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
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $content = __('A new request is created by :name', ['name' => Auth::user()->first_name . ' ' . Auth::user()->last_name]);
        return (new MailMessage)
            ->line($content)
            ->action('Check it', route('admin.dashboard'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase(object $notifiable): DatabaseMessage  //|array
    {
        return new DatabaseMessage($this->createMessage());
    }

    protected function createMessage(): array
    {
        return [
            'title' => __('A new request is created by :name', ['name' => Auth::user()->first_name . ' ' . Auth::user()->last_name]),
            'link' => route('admin.dashboard'),
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
