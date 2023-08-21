<?php

namespace Tapp\FilamentSurvey\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Export extends Mailable
{
    use Queueable;
    use SerializesModels;

    public $attachment;

    public $filename;

    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($attachment, $filename, $subject)
    {
        $this->attachment = $attachment;
        $this->filename = $filename;
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('filament-survey::mail.export')
            ->subject($this->subject)
            ->attach($this->attachment, [
                'as' => $this->filename,
            ]);
    }
}
