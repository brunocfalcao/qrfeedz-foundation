<?php

namespace QRFeedz\Foundation\Abstracts;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

abstract class QRFeedzModel extends Notification
{
    use Queueable;

    public function via(object $notifiable): array
    {
        return ['mail'];
    }
}
