<?php


namespace Modules\Newsletter\Emails;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;
    public $content;
    public function __construct($content)
    {
        $this->content = $content;
    }

    public function build()
    {
        return $this->subject($this->subject)->markdown('newsletter::mails.newsletter');
    }
}
