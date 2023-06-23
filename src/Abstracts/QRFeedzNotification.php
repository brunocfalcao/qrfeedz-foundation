<?php

namespace QRFeedz\Foundation\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

abstract class QRFeedzNotification extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }
}
