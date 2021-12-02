<?php


namespace Modules\Executive\Jobs;



use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Executive\Http\Requests\MembershipRequest;
use Modules\Executive\Mail\MembershipRequestMail;

class SendMembershipRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $applicant;
    public function __construct(array $applicant)
    {
        $this->applicant = $applicant;
    }

    public function handle()
    {
        if(!is_null(site('secondary_email'))){
            Mail::to(site('secondary_email'))
                ->cc(site('primary_email'))
                ->send(new MembershipRequestMail($this->applicant));
        } else {
            Mail::to('asonarthroscopy@gmail.com')
                ->send(new MembershipRequestMail($this->applicant));
            Log::notice('Membership request email not configured.');
        }
    }
}
