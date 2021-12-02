<?php


namespace Modules\Newsletter\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\URL;
use Modules\Newsletter\Models\Subscriber;

class VerifySubscriber extends Notification implements ShouldQueue
{
    use Queueable;
    public $subscriber;
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     * @return MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->greeting('Hello!, '.$this->subscriber->name)
            ->subject('Verify your subscription')
            ->action('Verify', URL::signedRoute('subscription.verify',['subscriber'=>encrypt($this->subscriber->email)]))
            ->line('Thank you for subscribing to our newsletter. You are just one step away and be updated with our various offers.');
    }
}
