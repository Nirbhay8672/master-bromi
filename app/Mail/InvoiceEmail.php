<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceEmail extends Mailable
{
    use Queueable, SerializesModels;

    protected $eTemplate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($template)
    {
        $this->eTemplate = $template;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.InvoiceEmail')->with(['eTemplate' => $this->eTemplate]);
    }
}
