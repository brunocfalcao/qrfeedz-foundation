<?php

namespace QRFeedz\Foundation\Abstracts;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\App;
use QRFeedz\Cube\Models\User;

class QRFeedzMail extends Mailable
{
    // Extra data, always passed to the view.
    public $data = [];

    // The notifiable object, always passed to the view.
    public $notifiable = null;

    // The preview message, for mobile devices. Always passed to the view.
    public $preview = null;

    // The localization filename to be used. Must respect a specific structure.
    public $localePrefix = null;

    public function __construct(object $notifiable, array $data = [])
    {
        if ($notifiable instanceof User) {
            App::setLocale($notifiable->locale->canonical);
        }

        $this->notifiable = $notifiable;

        if ($this->localePrefix != null) {
            $this->subject = __("qrfeedz-services::{$this->localePrefix}.subject");
            $this->preview = __("qrfeedz-services::{$this->localePrefix}.preview");
        }

        $this->data = array_merge($this->data, $data);

        $this->markdown = 'qrfeedz-services::'.$this->markdown;
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
            with: array_merge($this->data, [
                'subject' => $this->subject,
            ])
        );
    }

    public function attachments(): array
    {
        return [];
    }

    /**
     * Small override to the original send() method since it needs to consider
     * the general send notification config flag.
     */
    public function send($mailer)
    {
        if (config('qrfeedz.system.allow_notifications') === true) {
            parent::send($mailer);
        }
    }
}
