<?php

namespace App\Jobs;

use App\Notifications\ContactMailReceived;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Modules\User\Models\User;

class SendContactMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $name, $address,$email,$phone,$message,$callMe;

    /**
     * Create a new job instance.
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
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = User::permission('receive contact mail')->get();
        foreach($users as $user){
            $user->notify(new ContactMailReceived(
                $this->name,
                $this->email,
                $this->message,
                $this->callMe,
                $this->address,
                $this->phone)
            );
        }
    }
}
