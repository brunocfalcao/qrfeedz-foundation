<?php

namespace QRFeedz\Foundation\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\App;
use QRFeedz\Cube\Models\User;

class QRFeedzMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    // Extra data, always passed to the view.
    public $data = [];

    // The notifiable object, always passed to the view.
    public $notifiable = null;

    // The preview message, for mobile devices. Always passed to the view.
    public $preview = null;

    // The localization filename to be used. Must respect a specific structure.
    public $localFilename = null;

    public function __construct(object $notifiable, array $data = [])
    {
        if ($notifiable instanceof User) {
            App::setLocale($notifiable->locale->canonical);
        }

        $this->notifiable = $notifiable;

        if ($this->localFilename != null) {
            $this->subject = __("qrfeedz::{$this->localFilename}.subject");
            $this->preview = __("qrfeedz::{$this->localFilename}.preview");
        }

        dd($this->subject);

        $this->data = array_merge($this->data, $data);

        // Default queue for sending qrfeedz emails.
        $this->queue = config('qrfeedz.system.mails.queue_name');
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address(
                config('qrfeedz.system.mails.contact.email'),
                config('qrfeedz.system.mails.contact.name')
            ),
            replyTo: [
                new Address(
                    config('qrfeedz.system.mails.contact.email'),
                    config('qrfeedz.system.mails.contact.name')
                ),
            ],
            subject: $this->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: $this->markdown,
            with: $this->data
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
