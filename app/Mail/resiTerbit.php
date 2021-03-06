<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class resiTerbit extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('gunungmakomamasyariat01@gmail.com', "Gunung Mako Mama Syariat")
            ->markdown('mail.resiTerbit', ['data' => $this->data])
            ->subject("Pesanan anda berhasil terkirim, silahkan tunggu konfirmasi dari admin");
    }
}
