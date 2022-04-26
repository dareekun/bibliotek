<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    protected $token;
    protected $email;

    public function __construct($nik, $pin)
    {
        
        $this->token = $pin;
        $this->email = $nik;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $name   = DB::table('users')->where('nik', $this->email)->limit(1)->value('name');
        $link   = config('base_url') . 'reset-password/' . $this->token . '?nik=' . urlencode($this->email);
        $easter = DB::table('easter')->where('id', rand(1,450))->value('text');
        return $this->from('notify.no_reply@mli.panasonic.co.id')
                    ->subject('Recover Password')
                    ->view('mail.reset_password')
                    ->with([
                        'link'   => $link,
                        'nama'   => $name,
                        'easter' => $easter,
                    ]);
    }
}
