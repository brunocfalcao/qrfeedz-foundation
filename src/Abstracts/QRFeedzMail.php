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

    public $data = [];

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
            with: array_merge($this->data,
                ['preview' => $this->preview ?? $this->subject])
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
