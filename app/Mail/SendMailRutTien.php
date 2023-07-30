<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailRutTien extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $infoUser;
    public $trans;
    public function __construct( $infoUser,$trans)
    {
        //
        $this->infoUser = $infoUser;
        $this->trans = $trans;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Rút Tiền thành công')->view('mail.ruttien');
    }
}
