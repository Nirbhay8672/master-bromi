<?php

use Illuminate\Mail\Mailable;

class DynamicEmail extends Mailable
{
    public $templateData;

    public function __construct($templateData)
    {
        $this->templateData = $templateData;
    }

    public function build()
    {
        return $this->from($this->templateData['from'])->view($this->templateData['template'])->with('data', $this->templateData);
    }
}
