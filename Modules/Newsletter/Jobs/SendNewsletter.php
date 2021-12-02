<?php


namespace Modules\Newsletter\Jobs;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Modules\Newsletter\Emails\Newsletter;

class SendNewsletter implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $recipients,$subject, $content;
    public function __construct(Collection $recipients,$subject, $content)
    {
        $this->recipients = $recipients;
        $this->subject = $subject;
        $this->content = $content;
    }

    public function handle()
    {
        foreach ($this->recipients as $recipient){

            Mail::to($recipient->email)->send(new Newsletter($this->parseTemplate($this->content, $recipient)));
        }
    }

    public function parseTemplate($content,$recipient){
        $mustache = new \Mustache_Engine(['entity_flags'=>ENT_QUOTES]);
        return $mustache->render(html_entity_decode($content),[
            'name'=>$recipient->name,
            'email'=>$recipient->email,
            'unsubscribe'=>URL::signedRoute('unsubscribe',['subscriber'=>encrypt($recipient->email)]),
            'appName'=>site('name'),
            'appUrl'=>env('APP_URL'),
            'year'=>date('Y')
        ]);
    }
}
