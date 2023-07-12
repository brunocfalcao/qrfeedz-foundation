<?php

namespace QRFeedz\Foundation\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class QRFeedzMail extends Mailable
{
    use Queueable, SerializesModels;

    // Extra data passed to the email view.
    public $data = [];

    // The notifiable object, always passed to the view.
    public $notifiable = null;

    // The preview message, for mobile devices. Always passed to the view.
    public $preview = null;

    public function __construct()
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: $this->markdown,
            with: array_merge(
                $this->data,
                [
                    'preview' => $this->preview,
                    'notifiable' => $this->notifiable
                ]
            )
        );
    }

    public function attachments(): array
    {
        return [];
    }
}