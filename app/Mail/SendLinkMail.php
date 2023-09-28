<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $data;
    /**
     * The number of times the job may be attempted.
     * @var int
     */
    public $tries = 5;

    /**
     * The number of seconds the job can run before timing out.
     * @var int
     */
    public $timeout = 60;
    /**
     * Create a new message instance.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mail.SendLinkMail')
                    ->subject("Đổi mật khẩu")
                    ->with($this->data);
    }
}
