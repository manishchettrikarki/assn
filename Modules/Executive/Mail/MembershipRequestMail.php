<?php

namespace Modules\Executive\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Storage;
use Modules\Executive\Http\Requests\MembershipRequest;

class MembershipRequestMail extends Mailable
{
    use Queueable, SerializesModels;
    public $applicant;

    /**
     * Create a new message instance.
     *
     * @param MembershipRequest $request
     */
    public function __construct(array $applicant)
    {
        $this->applicant = $applicant;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $email = $this->markdown('executive::mails.membership-request')->subject('New Membership Request');
        if($this->applicant['photo']) {
            $email->attach(storage_path('app/temp/' . $this->applicant['folder'] . '/' . $this->applicant['photo']));
        }
        if($this->applicant['signature']) {
            $email->attach(storage_path('app/temp/' . $this->applicant['folder'] . '/' . $this->applicant['signature']));
        }

        return $email;
    }
}
