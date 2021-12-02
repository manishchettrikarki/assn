<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ContactMailReceived extends Notification
{
    use Queueable;
    public $name, $address,$email,$phone,$message,$callMe;

    /**
     * Create a new notification instance.
     *
     * @param $name
     * @param $email
     * @param $message
     * @param $callMe
     * @param null $address
     * @param null $phone
     */
    public function __construct($name, $email, $message, $callMe, $address=null, $phone=null)
    {
        $this->name = $name;
        $this->email = $email;
        $this->message = $message;
        $this->callMe = $callMe;
        $this->address = $address;
        $this->phone = $phone;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {

        return  (new MailMessage)
            ->subject('New Contact Mail')
                    ->view('mail.contactmail',[
                        'name'=>$this->name,
                        'email'=>$this->email,
                        'text'=>$this->message,
                        'callMe'=>$this->callMe,
                        'address'=>$this->address,
                        'phone'=>$this->phone
                    ]);
    }

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
