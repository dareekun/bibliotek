<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InternalSender extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $link;
    protected $pic;
    protected $cat;
    protected $sta;
    protected $exp;
    protected $nod;

    public function __construct($a1, $a2, $a3, $a4, $a5)
    {
        
        $this->link = $a1;
        $this->pic  = $a2;
        $this->cat  = $a3;
        $this->exp  = $a4;
        $this->ndc  = $a5;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $easter = DB::table('easter')->where('id', rand(1,450))->value('text');
        return $this->from('mada.baskoro@mli.panasonic.co.id')
                    ->subject('Reminder Near Expired Document')
                    ->markdown('mail.internal')
                    ->with([
                        'nama'   => $this->pic,
                        'cat'    => $this->cat,
                        'link'   => $this->link,
                        'exp'    => $this->exp,
                        'nodoc'  => $this->ndc,
                        'easter' => $easter,
                    ]);
    }
}