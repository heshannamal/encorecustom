<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;

class PosReceiptMail extends Mailable
{
    public $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this
            ->subject('Encore E-Bill Receipt')
            ->view('pages.pos.ebill.index');
    }
}
